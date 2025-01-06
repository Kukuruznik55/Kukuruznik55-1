// Задание 1. 

function isPrime(number) {
    if (number <= 1) {
        return false; // 1 и отрицательные числа не являются простыми
    }

    for (let i = 2; i <= Math.sqrt(number); i++) {
        if (number % i === 0) {
            return false; // число делится нацело, не является простым
        }
    }

    return true; // если не найдены делители, число простое
}

// Пример использования
const inputNumber = -5; // 
if (isPrime(inputNumber)) {
    console.log(`${inputNumber} - простое число`);
} else {
    console.log(`${inputNumber} - не простое число`);
}



// Задание 2, Часть А. 
function sumUntilPositiveSin(arr) {
    let sum = 0;
    let foundPositiveSin = false;

    for (let i = 0; i < arr.length; i++) {
        sum += arr[i];

        if (Math.sin(arr[i]) > 0) {
            foundPositiveSin = true;
            break;
        }
    }

    if (!foundPositiveSin) {
        console.log('В массиве нет числа, синус которого положителен.');
    }

    return sum;
}

// Пример использования
const numbersArray = [1, 2, 3, 4, 5, 6];
const resultSum = sumUntilPositiveSin(numbersArray);
console.log(`Сумма элементов массива до первого числа с положительным синусом: ${resultSum}`);
//  Часть Б.

function removeEvenDigitsElements(arr) {
    const filteredArray = arr.filter((element) => {
        const integerPart = Math.abs(Math.trunc(element));
        const allDigitsEven = String(integerPart).split('').every(digit => digit % 2 === 0);
        return !allDigitsEven;
    });

    return filteredArray;
}

// Пример использования
const numbersArray2 = [2.34, -3.45, 6.78, -12.34, 56.78, 123.456];
const filteredResult = removeEvenDigitsElements(numbersArray2);
console.log('Массив после удаления элементов:', filteredResult);



// Задание 3.

function countSyllables(word) {
    // Простое правило для подсчета слогов: количество гласных в слове
    const vowels = word.match(/[aeiouyаеёиоуыэюя]/gi); // Регулярное выражение для поиска гласных
    const syllableCount = vowels ? vowels.length : 0;

    return syllableCount;
}

// Пример использования
const inputWord = "программирование";
const syllableCountResult = countSyllables(inputWord);
console.log(`Количество слогов в слове "${inputWord}": ${syllableCountResult}`);
