import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet
} from "react-native";
import { Container, Header, Content, Form, Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
// import Ionicons from 'react-native-vector-icons/Ionicons'
import { WebView } from 'react-native';
import { connect } from 'react-redux'
import { BASE_URL } from '../../env'


class ProfilScreen extends Component {
  render() {
    return (
          <WebView
            source={{uri: ""+BASE_URL+"/webview/"+this.props.auth.token+"/2018-08-18?page=1"}}
          />
    )
  }
}


// export default ProfilScreen;
const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({
  // loginFetch: (email, password) => dispatch(loginFetch(email, password)),
  // setToken: (token) => dispatch(setToken(token))
})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(ProfilScreen)
