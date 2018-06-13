import { AsyncStorage } from 'react-native'
import { LOGIN_URL, BASE_URL } from '../env'

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

export const destroyID = () => {
  return {
    type: 'destroyID'
  }
}

export const absen_sukses = (id_presensi) => {
  return {
    type: 'sukses_absen',
    payload: {
      id_presensi: id_presensi
    }
  }
}

export const setID = (id_presensi) => {
  return {
    type: 'setID',
    payload: {
      id_presensi: id_presensi
    }
  }
}

export const absenFetch = (token,lokasi) => {
  return (dispatch) => {
    return fetch(BASE_URL+'api/absen', {
      method:'POST',
      headers: {
        'Accept'       : 'application/json',
        'Authorization': 'Bearer ' + token,
        'Content-Type' : 'application/json'
      },
      body: JSON.stringify({
        lokasi_absen: lokasi,
      })
    })
    .then((response) => response.json())
    .then((json) => {
      if (json.error) {
        alert(json.error)
      } else {
        alert('anda berhasil mengisi presensi')
        AsyncStorage.setItem('id_presensi', json.id_presensi.toString()).then(
          () => {
            dispatch(absen_sukses(json.id_presensi.toString()))
          }
        ).done()
      }
    })
    .catch((error) => {
      alert('error! pastikan gps anda dinyalakan!')
      console.log(error)
    })
  }
}

export const logoutAbsenFetch = (token,id_presensi) => {
  return (dispatch) => {
    return fetch(BASE_URL+'api/logoutabsen', {
      method:'POST',
      headers: {
        'Accept'       : 'application/json',
        'Authorization': 'Bearer ' + token,
        'Content-Type' : 'application/json'
      },
      body: JSON.stringify({
        id: id_presensi,
      })
    })
    .then((response) => response.json())
    .then((json) => {
      if (json.error) {
        alert(json.error)
      } else {
        alert('anda sukses absen selama : '+ json.diff)
      }
    })
    .catch((error) => {
      console.error(error)
    })
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
      if (json.error) {
        alert(json.error)
      } else {
        AsyncStorage.setItem('token', json.meta.token).then(
          () => {
            dispatch(loginSuccess(json.meta))
          }
        ).done()
      }
    })
    .catch((error) => {
      console.error(error);
    })
  }
}
