interface Token {
    id: number,
    lastUsed: string,
    name: string,
}

interface User {
    id: number,
    name: string,
    email: string,
    tokens: Token[],
}