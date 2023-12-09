var surname;
var surnameNum = 0;
var name;
var nameNum = 0;
var patronymic;
var patronymicNum = 0;
var daybirth;
var monthbirth;
var yearbirth;
var birthNum = 0;
var snpNum = 0;
var goldSum = 0;

function enterValue () {
	surname = document.getElementById("surname").value;
	name = document.getElementById("name").value;
	patronymic = document.getElementById("patronymic").value;
	daybirth = document.getElementById("dayBirth").value;
	monthbirth = document.getElementById("monthBirth").value;
	yearbirth = document.getElementById("yearBirth").value;
	surnameNum = 0;
	nameNum = 0;
	patronymicNum = 0;
	birthNum = 0;
	snpNum = 0;
	goldSum = 0;
	document.getElementById("first").style.display = "none";
	document.getElementById("sun").style.display = "none";
	document.getElementById("moon").style.display = "none";
	document.getElementById("mars").style.display = "none";
	document.getElementById("mercury").style.display = "none";
	document.getElementById("jupiter").style.display = "none";
	document.getElementById("venus").style.display = "none";
	document.getElementById("saturn").style.display = "none";
	document.getElementById("uranus").style.display = "none";
	document.getElementById("neptun").style.display = "none";
	deleteResult();
	surnameTransfer();
}

function surnameTransfer () {
	surname = surname.toLowerCase();
	surname = $.trim(surname);
	sTC: for (var i = 0; i < surname.length; i++) {
		if (surname[i] == "а" || surname[i] == "и" || surname[i] == "с" || surname[i] == "ъ" || surname[i] == "a" || surname[i] == "j" || surname[i] == "s") {
			surnameNum += 1;
		} else if (surname[i] == "б" || surname[i] == "й" || surname[i] == "т" || surname[i] == "ы" || surname[i] == "b" || surname[i] == "k" || surname[i] == "t") {
			surnameNum += 2;
		} else if (surname[i] == "в" || surname[i] == "к" || surname[i] == "у" || surname[i] == "ь" || surname[i] == "c" || surname[i] == "l" || surname[i] == "u") {
			surnameNum += 3;
		} else if (surname[i] == "г" || surname[i] == "л" || surname[i] == "ф" || surname[i] == "э" || surname[i] == "d" || surname[i] == "m" || surname[i] == "v") {
			surnameNum += 4;
		} else if (surname[i] == "д" || surname[i] == "м" || surname[i] == "х" || surname[i] == "ю" || surname[i] == "e" || surname[i] == "n" || surname[i] == "w") {
			surnameNum += 5;
		} else if (surname[i] == "е" || surname[i] == "н" || surname[i] == "ц" || surname[i] == "я" || surname[i] == "f" || surname[i] == "o" || surname[i] == "x") {
			surnameNum += 6;
		} else if (surname[i] == "ё" || surname[i] == "о" || surname[i] == "ч" || surname[i] == "g" || surname[i] == "p" || surname[i] == "y") {
			surnameNum += 7;
		} else if (surname[i] == "ж" || surname[i] == "п" || surname[i] == "ш" || surname[i] == "h" || surname[i] == "q" || surname[i] == "z") {
			surnameNum += 8;
		} else if (surname[i] == "з" || surname[i] == "р" || surname[i] == "щ" || surname[i] == "i" || surname[i] == "r") {
			surnameNum += 9;
		} else {
			alert("Ошибка в фамилии! Невозможно провести анализ. Введите данные заново");
			return 0;
		}
	}
	if (surnameNum == 0) {
		alert("Вы не ввели фамилию!")
		return 0;
	}
	surnameNum = String(surnameNum);
	for (; surnameNum.length > 1;) {
		var surNum = surnameNum;
		surnameNum = 0;
		for (var x = 0; x < surNum.length; x++) {
			surnameNum += +surNum[x];
		}
		surnameNum = String(surnameNum);
	}
	nameTrunsfer();
}

function nameTrunsfer () {
	name = name.toLowerCase();
	name = $.trim(name);
	nTC: for (var i = 0; i < name.length; i++) {
		if (name[i] == "а" || name[i] == "и" || name[i] == "с" || name[i] == "ъ" || name[i] == "a" || name[i] == "j" || name[i] == "s") {
			nameNum += 1;
		} else if (name[i] == "б" || name[i] == "й" || name[i] == "т" || name[i] == "ы" || name[i] == "b" || name[i] == "k" || name[i] == "t") {
			nameNum += 2;
		} else if (name[i] == "в" || name[i] == "к" || name[i] == "у" || name[i] == "ь" || name[i] == "c" || name[i] == "l" || name[i] == "u") {
			nameNum += 3;
		} else if (name[i] == "г" || name[i] == "л" || name[i] == "ф" || name[i] == "э" || name[i] == "d" || name[i] == "m" || name[i] == "v") {
			nameNum += 4;
		} else if (name[i] == "д" || name[i] == "м" || name[i] == "х" || name[i] == "ю" || name[i] == "e" || name[i] == "n" || name[i] == "w") {
			nameNum += 5;
		} else if (name[i] == "е" || name[i] == "н" || name[i] == "ц" || name[i] == "я" || name[i] == "f" || name[i] == "o" || name[i] == "x") {
			nameNum += 6;
		} else if (name[i] == "ё" || name[i] == "о" || name[i] == "ч" || name[i] == "g" || name[i] == "p" || name[i] == "y") {
			nameNum += 7;
		} else if (name[i] == "ж" || name[i] == "п" || name[i] == "ш" || name[i] == "h" || name[i] == "q" || name[i] == "z") {
			nameNum += 8;
		} else if (name[i] == "з" || name[i] == "р" || name[i] == "щ" || name[i] == "i" || name[i] == "r") {
			nameNum += 9;
		} else {
			alert("Ошибка в имени! Невозможно провести анализ. Введите данные заново");
			return 0;
		}
	}
	if (nameNum == 0) {
		alert("Вы не ввели имя!")
		return 0;
	}
	nameNum = String(nameNum);
	for (; nameNum.length > 1;) {
		var namNum = nameNum;
		nameNum = 0;
		for (var x = 0; x < namNum.length; x++) {
			nameNum += +namNum[x];
		}
		nameNum = String(nameNum);
	}
	patronymicTrunsfer();
}

function patronymicTrunsfer () {
	patronymic = patronymic.toLowerCase();
	patronymic = $.trim(patronymic);
	pTC: for (var i = 0; i < patronymic.length; i++) {
		if (patronymic[i] == "а" || patronymic[i] == "и" || patronymic[i] == "с" || patronymic[i] == "ъ" || patronymic[i] == "a" || patronymic[i] == "j" || patronymic[i] == "s") {
			patronymicNum += 1;
		} else if (patronymic[i] == "б" || patronymic[i] == "й" || patronymic[i] == "т" || patronymic[i] == "ы" || patronymic[i] == "b" || patronymic[i] == "k" || patronymic[i] == "t") {
			patronymicNum += 2;
		} else if (patronymic[i] == "в" || patronymic[i] == "к" || patronymic[i] == "у" || patronymic[i] == "ь" || patronymic[i] == "c" || patronymic[i] == "l" || patronymic[i] == "u") {
			patronymicNum += 3;
		} else if (patronymic[i] == "г" || patronymic[i] == "л" || patronymic[i] == "ф" || patronymic[i] == "э" || patronymic[i] == "d" || patronymic[i] == "m" || patronymic[i] == "v") {
			patronymicNum += 4;
		} else if (patronymic[i] == "д" || patronymic[i] == "м" || patronymic[i] == "х" || patronymic[i] == "ю" || patronymic[i] == "e" || patronymic[i] == "n" || patronymic[i] == "w") {
			patronymicNum += 5;
		} else if (patronymic[i] == "е" || patronymic[i] == "н" || patronymic[i] == "ц" || patronymic[i] == "я" || patronymic[i] == "f" || patronymic[i] == "o" || patronymic[i] == "x") {
			patronymicNum += 6;
		} else if (patronymic[i] == "ё" || patronymic[i] == "о" || patronymic[i] == "ч" || patronymic[i] == "g" || patronymic[i] == "p" || patronymic[i] == "y") {
			patronymicNum += 7;
		} else if (patronymic[i] == "ж" || patronymic[i] == "п" || patronymic[i] == "ш" || patronymic[i] == "h" || patronymic[i] == "q" || patronymic[i] == "z") {
			patronymicNum += 8;
		} else if (patronymic[i] == "з" || patronymic[i] == "р" || patronymic[i] == "щ" || patronymic[i] == "i" || patronymic[i] == "r") {
			patronymicNum += 9;
		} else {
			alert("Ошибка в отчестве! Невозможно провести анализ. Введите данные заново");
			return 0;
		}
	}
	patronymicNum = String(patronymicNum);
	for (; patronymicNum.length > 1;) {
		var patNum = patronymicNum;
		patronymicNum = 0;
		for (var x = 0; x < patNum.length; x++) {
			patronymicNum += +patNum[x];
		}
		patronymicNum = String(patronymicNum);
	}
	birthTransfer();
}

function birthTransfer () {
	daybirth = String(daybirth);
	daybirth = $.trim(daybirth);
	if (daybirth.length != 2) {
		alert("Вы некорректно ввели дату рождения!");
		return 0;
	}
	for (; daybirth.length > 1;) {
		var dBirNum = daybirth;
		daybirth = 0;
		for (var x = 0; x < dBirNum.length; x++) {
			daybirth += +dBirNum[x];
		}
		daybirth = String(daybirth);
	}
	if (daybirth == 0 || daybirth == NaN || daybirth == undefined) {
		alert("Вы ввели неверную дату рождения! Обработка данных невозможна.");
		return 0;
	}

	monthbirth = $.trim(monthbirth);
	monthbirth = String(monthbirth);
	if (monthbirth.length != 2) {
		alert("Вы некорректно ввели дату рождения!");
		return 0;
	}
	for (; monthbirth.length > 1;) {
		var mBirNum = monthbirth;
		monthbirth = 0;
		for (var x = 0; x < mBirNum.length; x++) {
			monthbirth += +mBirNum[x];
		}
		monthbirth = String(monthbirth);
	}
	if (monthbirth == 0 || monthbirth == NaN || monthbirth == undefined) {
		alert("Вы ввели неверную дату рождения! Обработка данных невозможна.");
		return 0;
	}

	yearbirth = $.trim(yearbirth);
	yearbirth = String(yearbirth);
	if (yearbirth.length != 4) {
		alert("Вы некорректно ввели дату рождения!");
		return 0;
	}
	for (; yearbirth.length > 1;) {
		var yBirNum = yearbirth;
		yearbirth = 0;
		for (var x = 0; x < yBirNum.length; x++) {
			yearbirth += +yBirNum[x];
		}
		yearbirth = String(yearbirth);
	}
	if (yearbirth == 0 || yearbirth == NaN || yearbirth == undefined) {
		alert("Вы ввели неверную дату рождения! Обработка данных невозможна.");
		return 0;
	}
	birthMath();
}

function birthMath () {
	birthNum += +daybirth;
	birthNum += +monthbirth;
	birthNum += +yearbirth;
	birthNum = String(birthNum);
	for (; birthNum.length > 1;) {
		var birNum = birthNum;
		birthNum = 0;
		for (var x = 0; x < birNum.length; x++) {
			birthNum += +birNum[x];
		}
		birthNum = String(birthNum);
	}
	snpMath();
}

function snpMath () {
	snpNum += +surnameNum;
	snpNum += +nameNum;
	snpNum += +patronymicNum;
	snpNum = String(snpNum);
	for (; snpNum.length > 1;) {
		var snpNum2 = snpNum;
		snpNum = 0;
		for (var x = 0; x < snpNum2.length; x++) {
			snpNum += +snpNum2[x];
		}
		snpNum = String(snpNum);
	}
	goldNum();
}

function goldNum () {
	goldSum = +birthNum + +snpNum;
	goldSum = String(goldSum);
	for (; goldSum.length > 1;) {
		var goldSum2 = goldSum;
		goldSum = 0;
		for (var x = 0; x < goldSum2.length; x++) {
			goldSum += +goldSum2[x];
		}
		goldSum = String(goldSum);
	}
	symbolMath();
}

function symbolMath () {
	daybirth = replaceNum(daybirth);
	monthbirth = replaceNum(monthbirth);
	yearbirth = replaceNum(yearbirth);
	birthNum = replaceNum(birthNum);
	surnameNum = replaceNum(surnameNum);
	nameNum = replaceNum(nameNum);
	patronymicNum = replaceNum(patronymicNum);
	snpNum = replaceNum(snpNum);
	goldSum = replaceNum(goldSum);
	printResult();
}

function replaceNum (num) {
	if (+num == 1) {
		num = "&#9737;";
		document.getElementById("sun").style.display = "block";
	} else if (+num == 2) {
		num = "&#9790;";
		document.getElementById("moon").style.display = "block";
	} else if (+num == 3) {
		num = "&#9794;";
		document.getElementById("mars").style.display = "block";
	} else if (+num == 4) {
		num = "&#9791;";
		document.getElementById("mercury").style.display = "block";
	} else if (+num == 5) {
		num = "&#9795;";
		document.getElementById("jupiter").style.display = "block";
	} else if (+num == 6) {
		num = "&#9792;";
		document.getElementById("venus").style.display = "block";
	} else if (+num == 7) {
		num = "&#9796;";
		document.getElementById("saturn").style.display = "block";
	} else if (+num == 8) {
		num = "&#9797;";
		document.getElementById("uranus").style.display = "block";
	} else if (+num == 9) {
		num = "&#9798;";
		document.getElementById("neptun").style.display = "block";
	}
	return num;
}

function printResult () {
	var forPrint;
	forPrint = "Ваша числовая формула:<br>"+daybirth+" + "+monthbirth+" + "+yearbirth+" = "+birthNum+"<br>"+nameNum+" + "+patronymicNum+" + "+surnameNum+" = "+snpNum+"<br>"+birthNum+" + "+snpNum+" = "+goldSum+"<br>";
	document.getElementById("result").innerHTML += forPrint;
		document.getElementById("first").style.display = "block";
}

function deleteResult () {
	document.getElementById("result").innerHTML = "";
}
