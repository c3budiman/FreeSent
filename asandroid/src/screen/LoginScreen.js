import React, { Component } from 'react';
import {
  Platform,
  StyleSheet,
  Text,
  Image,
  View
} from 'react-native';
import { Container, Header, Content, Form, Item, Input, H1,
  Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import HeaderFreesent from '../Layouts/Header'
import LoginPage from '../Login'

class LoginScreen extends Component {
  static navigationOptions = ({ navigation }) => ({
      header: (
        <HeaderFreesent />
      )
    });
  render() {
    return (
      <Container style={{backgroundColor: '#fff'}}>
        <Content padder>
          <Image
            style={{width: 100, height: 100, alignSelf: "center", marginTop: 5, marginBottom: 10}}
            source={{uri: 'https://github.com/c3budiman/FreeSent/blob/master/absensi/public/images/logo.png?raw=true'}}
          />
          <Text style={{alignSelf: "center",marginBottom: 10}} note> &emsp; <Icon name="md-remove" style={{fontSize:10}} /> Kemudahan Absen, kini bisa dilakukan secara daring melalui segala jenis perangkat.</Text>
          <Item floatingLabel style={{marginBottom: 10}}>
            <Label>Email</Label>
            <Input itemType="email" name="email" />
          </Item>
          <Item floatingLabel style={{marginBottom: 30}}>
            <Label>Password</Label>
            <Input itemType="password" name="password" secureTextEntry={true} />
          </Item>
          <Button style={{backgroundColor: '#01a3af'}} block onPress={() => this.props.navigation.navigate("Presensi")}>
            <Text style={{color: '#fff'}}>Login</Text>
          </Button>
        </Content>
      </Container>
    )
  }
}

export default LoginScreen;
