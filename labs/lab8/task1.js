function isPrime(n) {
    if (n < 2) return false;
    if (n === 2) return true;
    if (n % 2 === 0) return false;
    for (let i = 3; i < n; i += 2) {
        if (n % i === 0) return false;
    }
    return true;
}

function isPrimeNumber(input) {
    if (Number.isFinite(input)) {
        let result = input;
        if (isPrime(input)) {
            result += ' простое число';
        } else {
            result += ' не простое число';
        }
        console.log(result);
        return;
    }
    if (Array.isArray(input)) {
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
        let result = '';
        if (primes.length > 0) {
            result += primes.join(', ');
            if (primes.length === 1) {
                result += ' простое число; ';
            } else {
                result += ' простые числа; ';
            }
        }
        if (notPrimes.length > 0) {
            result += notPrimes.join(', ');
            if (notPrimes.length === 1) {
                result += ' непростое число';
            } else {
                result += ' непростые числа';
            }
        }
        console.log(result);
        return;
    }
    console.log('Ошибка: параметр должен быть числом или массивом чисел');
}