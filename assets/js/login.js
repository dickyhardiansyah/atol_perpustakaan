function validateForm() {
    const tbUsername = document.querySelector('#username')
    const tbPassword = document.querySelector('#password')
    const errorUsername = document.querySelector('#username + small')
    const errorPassword = document.querySelector('#password + small')

    const username = tbUsername.value
    const password = tbPassword.value

    const EMPTY_ERROR = '* Isi ini dulu yuk'
    const USERNAME_ERROR = '* Usernamenya salah, coba dicek lagi yuk'
    const PASSWORD_ERROR = '* Passwordnya salah, coba dicek lagi yuk'

    if (username === '' || password === '') {
        if (username === '') {
            errorUsername.innerHTML = EMPTY_ERROR
            errorUsername.classList.remove('hide')
            tbUsername.classList.add('error-color')
        }

        if (password === '') {
            errorPassword.innerHTML = EMPTY_ERROR
            errorPassword.classList.remove('hide')
            tbPassword.classList.add('error-color')
        }

        return false
    } 

    if (username !== 'perpus-unikom' || password !== 'unikom123') {
        if (username !== 'bimbel-unikom') {
            errorUsername.innerHTML = USERNAME_ERROR
            errorUsername.classList.remove('hide')
            tbUsername.classList.add('error-color')
        }

        if (password !== 'unikom123') {
            errorPassword.innerHTML = PASSWORD_ERROR
            errorPassword.classList.remove('hide')
            tbPassword.classList.add('error-color')
        }

        return false
    }

    return true
}