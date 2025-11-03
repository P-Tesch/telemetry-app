export default interface RegisterPageProps {
    text: RegisterPageText
}

interface RegisterPageText {
    name: string,
    password: string,
    register: string,
    email: string,
    confirmation: string
}
