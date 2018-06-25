import React, { Component } from 'react';
import {  Platform,  StyleSheet,  Text,  Image, AsyncStorage } from 'react-native';
import { Container, Header, Content, Form, Item, Input, H1,
  Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import HeaderFreesent from '../Layouts/Header'
import { StackActions,NavigationActions } from 'react-navigation';
import { loginFetch,setToken } from '../action'
import { connect } from 'react-redux'
import { BASE_URL, BASE } from '../env'

class LoginScreen extends Component {
  constructor(props) {
  super(props)
  this.state = {
      email: null,
      password: null,
      Setting: null,
      Logo: null,
      Favicon: null,
      Slogan: null
    }
  }

  getSettingSitus() {
    fetch(BASE_URL+"api/setting", {
      method: "GET",
      headers: {
        'Accept' : 'application/json',
      }
    })
    .then((response) => response.json())
    .then((json) => {
      if (json.error) {

      } else {
        this.setState({Logo: json.data.logo, Favicon: json.data.favicon, Slogan: json.data.slogan})
      }
    })
    .catch((error) => {
      console.error(error)
    })
  }

  componentDidMount(){
    AsyncStorage.getItem('token').then((data)=> {
      if (data) {
        this.props.setToken(data)
      }
    }).done()
    this.getSettingSitus()
  }

  //This one add my custom header....
  static navigationOptions = ({ navigation }) => ({
      header: (
        <HeaderFreesent />
      )
    });

    //fungsi ini buat nge reset router, biar ga back ke login, tapi close app
    resetNavigation(targetRoute) {
      const resetAction = StackActions.reset({
        index: 0,
        actions: [
          NavigationActions.navigate({ routeName: targetRoute }),
        ],
      });
      this.props.navigation.dispatch(resetAction);
    };

    //good ol render
  render() {
    const { auth } = this.props
    if (auth.token) {
      this.resetNavigation('DrawerNavigator')
    }
    return (
      <Container style={{backgroundColor: '#fff'}}>
        <Content padder>
          <Image
            style={{width: 100, height: 100, alignSelf: "center", marginTop: 5, marginBottom: 10}}
            source={{uri: BASE+this.state.Favicon}}
          />
          <Text style={{alignSelf: "center",marginBottom: 10}} note> &emsp; <Icon name="md-remove" style={{fontSize:10}} /> {this.state.Slogan}</Text>
          <Item floatingLabel style={{marginBottom: 10}}>
            <Label>Email</Label>
            <Input itemType="email" name="email" value={this.state.email} onChangeText={(email) => this.setState({email})} />
          </Item>
          <Item floatingLabel style={{marginBottom: 30}}>
            <Label>Password</Label>
            <Input itemType="password" name="password" value={this.state.password} onChangeText={(password) => this.setState({password})} secureTextEntry={true} />
          </Item>
          <Button style={{backgroundColor: '#01a3af'}} block onPress={() => this.props.loginFetch(this.state.email, this.state.password)}>
            <Text style={{color: '#fff'}}>Login</Text>
          </Button>
        </Content>
      </Container>
    )
  }
}

const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({
  loginFetch: (email, password) => dispatch(loginFetch(email, password)),
  setToken: (token) => dispatch(setToken(token))
})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(LoginScreen)
