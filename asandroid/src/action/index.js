import { AsyncStorage } from 'react-native'
import { LOGIN_URL } from '../env'

export const loginSuccess = (meta) => {
  return {
    type: 'Login_Success',
    payload: {
      meta: meta
    }
  }
}

export const setToken = (token) => {
  return {
    type: 'Login_token',
    payload: {
      token: token
    }
  }
}

export const logout = () => {
  return {
    type: 'logout'
  }
}

export const terlogin = (id_presensi) => {
  return {
    type: 'terlogin',
    payload: {
      id_presensi: id_presensi
    }
  }
}

export const setIdTerlogin = (id) => {
  return {
    type: 'Login_token',
    payload: {
      token: token
    }
  }
}

export const loginFetch = (email, password) => {
  return (dispatch) => {
    return fetch(LOGIN_URL, {
      method:'POST',
      headers: {
        'Content-Type' : 'application/json'
      },
      body: JSON.stringify({
        email: email,
        password: password
      })
    })
    .then((response) => response.json())
    .then((json) => {
      AsyncStorage.setItem('token', json.meta.token).then(
        () => {
          dispatch(loginSuccess(json.meta))
        }
      ).done()
    })
    .catch((error) => {
      console.log(error)
    })
  }
}
