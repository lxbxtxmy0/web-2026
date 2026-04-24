function isVowels(ch) {
    const vowels = 'АЕЁИОУЫЭЮЯаеёиоуыэюя';
    return vowels.includes(ch);
}

function countVowels(str) {
    if (typeof(str) != 'string') {
        console.log('Invalid input');
        return;
    }

    let count = 0;
    const vowels = [];

    for (let ch of str) {
        if (isVowels(ch)) {
            count += 1;
            vowels.push(ch);
        }
    }

    let result;
    if (count > 0) {
        result = '(' + vowels.join(', ') + ')';
    } else {
        result = '(гласных нет)';
    }

    console.log(count + ' ' + result);
}