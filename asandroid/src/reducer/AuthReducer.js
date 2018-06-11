import { AsyncStorage } from 'react-native'

const INIT_STATE = {
  token: '',
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
    case 'terlogin':
        return {...state, terlogin:action.payload.terlogin}
        break;
    default:
      return state
  }
}
export default auth
