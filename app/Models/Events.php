<?php

namespace App\Models;

use App\Events\PublicEvent;
use App\Events\UserEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Events
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $type
 * @property mixed $data
 * @property bool $important
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $seenBy
 * @property-read int|null $seen_by_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Events newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Events newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Events query()
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereImportant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Events whereUserId($value)
 * @mixin \Eloquent
 */
class Events extends Model
{
    use HasFactory;

    const CHANGED_PASSWORD = -5;
    const CHANGED_PROFILE = -5;
    const CHANGED_AVATAR = -4;
    const VISIT_PAGE = -3;
    const USER_LOGOUT = -2;
    const USER_LOGIN = -1;
    const UNKNOWN = 0;
    const NEW_MESSAGE = 1;
    const MESSAGE_READ = 2;
    const MESSAGES_DELETED = 3;
    const NEW_CHAT = 4;
    const CHAT_DELETED = 5;
    const NEW_CHAT_MEMBER = 6;
    const CHAT_MEMBER_LEFT = 7;
    const CHAT_MEMBER_KICKED = 8;
    const MESSAGE_EDITED = 9;

    public static function getTypes()
    {
        return [
            self::VISIT_PAGE            => 'Посещение страницы',
            self::USER_LOGOUT           => 'Пользователь вышел из сети',
            self::USER_LOGIN            => 'Пользователь в сети',
            self::UNKNOWN               => 'Неизвестное событие',
            self::NEW_MESSAGE           => 'Новое сообщение',
            self::MESSAGE_READ          => 'Сообщение прочитано',
            self::MESSAGES_DELETED      => 'Сообщение удалено',
            self::NEW_CHAT              => 'Новый чат',
            self::CHAT_DELETED          => 'Чат удален',
            self::NEW_CHAT_MEMBER       => 'Участник присоединился к чату',
            self::CHAT_MEMBER_LEFT      => 'Участник покинул чат',
            self::CHAT_MEMBER_KICKED    => 'Участник был исключен из чата',
            self::MESSAGE_EDITED        => 'Сообщение отредактировано',
        ];
    }

    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'type',
        'data',
        'important',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seenBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'events_users', 'event_id', 'user_id');
    }

    public function see(?User $user = null)
    {
        if (is_null($user)) $user = auth()->user();
        if (is_null($user)) return;
        $this->seenBy()->attach($user->id, ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public static function fire(int $type = 0, array $data = [], string $eventClass = PublicEvent::class, ?User $user = null, bool $important = false)
    {
        if (is_null($user)) $user = auth()->user();
;
        if (!isset($data['type'])) $data['type'] = $type;

        $event = new self();
        $event->type = $type;
        $event->user_id = $user?->id;
        $event->data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $event->important = $important;
        $event->save();
        $event->see($user);

        event(new $eventClass($user?->id, $event->data, $event->id));
    }

    public static function fireUnseenImportant(?User $user = null)
    {
        if (is_null($user)) $user = auth()->user();
        if (is_null($user)) return;
        $events = Events::query()
            ->whereDoesntHave('seenBy', function (Builder $query) use ($user) {
                $query->where('user_id', '=', $user?->id);
            })
            ->where('important', '=', true)
            ->orderBy('created_at');
        /** @var Events $event */
        foreach (($events = $events->get()) as $event) {
            event(new UserEvent($user->id, $event->data, $event->id, strtotime($event->created_at)));
            $event->seenBy()->attach($user->id, ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }
    }
}
