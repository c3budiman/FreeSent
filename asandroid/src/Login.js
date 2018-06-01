import React , { Component } from 'react';
import { View, Image } from 'react-native';
import { Container, Item, Input, Header, Body, Content, Title, Button, Text, Label } from 'native-base';

export default class LoginPage extends Component {
  render(){
    return (
      <Content padder>
        <Image
          style={{width: 340, height: 70, alignSelf: "center", marginTop: 20, marginBottom: 10}}
          source={{uri: 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Facebook_New_Logo_%282015%29.svg/2000px-Facebook_New_Logo_%282015%29.svg.png'}}
        />
        <Item floatingLabel style={{marginBottom: 10}}>
          <Label>Email</Label>
          <Input itemType="email" name="email" />
        </Item>

        <Item floatingLabel style={{marginBottom: 30}}>
          <Label>Password</Label>
          <Input itemType="password" name="password" secureTextEntry={true} />
        </Item>
        <Button block primary>
          <Text>Submit</Text>
        </Button>
      </Content>
    )
  }
}
