const users = [
    { id: 1, name: "Alice" },
    { id: 2, name: "Bob" },
    { id: 3, name: "Charlie" }, null, 'hello'
];


function getNames(users) {
    if (!Array.isArray(users)) {
        console.log('invalid input');
        return;
    }
    const result = users.map(user => user?.name || 'noname');
    console.log(result);
}
getNames(users);