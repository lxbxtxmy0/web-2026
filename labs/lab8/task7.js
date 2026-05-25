function generatePassword(length) {
    if (length < 4 || length > 128) {
        return "Length is not between 4 and 128";
    }
    if (typeof length !== 'number') {
        return "length is not number";
    }
    const lower = 'abcdefghijklmnopqrstuvwxyz';
    const upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const digits = '0123456789';
    const symbols = '!@#$%^&*()_+';
    const all = lower + upper + digits + symbols;
    const password = [];

    password.push(lower[Math.floor(Math.random() * lower.length)]);
    password.push(upper[Math.floor(Math.random() * upper.length)]);
    password.push(digits[Math.floor(Math.random() * digits.length)]);
    password.push(symbols[Math.floor(Math.random() * symbols.length)]);

    for (let i = password.length; i < length; i++) {
        password.push(all[Math.floor(Math.random() * all.length)]);
    }

    for (let i = password.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        const temp = password[i];
        password[i] = password[j];
        password[j] = temp;
    }
    return password.join('');
}