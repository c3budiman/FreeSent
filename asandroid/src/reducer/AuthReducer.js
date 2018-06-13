import { AsyncStorage } from 'react-native'

const INIT_STATE = {
  token: '',
  id_presensi: '',
}

const auth = (state = INIT_STATE, action) => {
  switch (action.type) {
    case 'Login_Success':
      return {...state, token:action.payload.meta.token}
      break;
    case 'logout':
      return {...INIT_STATE}
      break;
    case 'Login_token':
        return {...state, token:action.payload.token}
        break;
    case 'sukses_absen':
        return {...state, id_presensi:action.payload.id_presensi}
        break;
    case 'setID':
        return {...state, id_presensi:action.payload.id_presensi}
        break;
    case 'destroyID':
        return {...state, id_presensi:null}
        break;
    default:
      return state
  }
}
export default auth
