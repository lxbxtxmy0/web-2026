function isPrime(n) {
    if (n < 2) return false;
    if (n === 2) return true;
    if (n % 2 === 0) return false;
    for (let i = 3; i < n; i += 2) {
        if (n % i === 0) return false;
    }
    return true;
}

function processSingleValue(input) {
    let result = input;
    if (isPrime(input)) {
        result += ' простое число';
    } else {
        result += ' не простое число';
    }
    console.log(result);
}

function formatResultString(primes, notPrimes) {
    let result = '';
    if (primes.length > 0) {
        result += primes.join(', ');
        result += primes.length === 1 ? ' простое число; ' : ' простые числа; ';
    }
    if (notPrimes.length > 0) {
        result += notPrimes.join(', ');
        result += notPrimes.length === 1 ? ' непростое число' : ' непростые числа';
    }
    console.log(result);
}

function processArray(input) {
    const primes = [];
    const notPrimes = [];
    for (let elt of input) {
        if (!Number.isFinite(elt)) {
            console.log('Ошибка: элемент массива не является числом');
            return;
        }
        if (isPrime(elt)) {
            primes.push(elt);
        } else {
            notPrimes.push(elt);
        }
    }
    formatResultString(primes, notPrimes);
}

function checkPrime(input) {
    if (Number.isFinite(input)) {
        processSingleValue(input);
        return;
    }
    if (Array.isArray(input)) {
        processArray(input);
        return;
    }
    console.log('Ошибка: параметр должен быть числом или массивом чисел');
}