import React , { Component } from 'react';
import { View, Image } from 'react-native';
import { Container, Item, Input, Header, Body, Content, Title, Button, Text, Label, Left, Right, Icon } from 'native-base';

export default class HeaderLoggedIn extends Component {
  render(){
    return (
        <Header style={{backgroundColor: '#01a3af'}} >
          <Left>

          </Left>
          <Body>
            <Title>FreeSent App</Title>
          </Body>
          <Right>
            <Button transparent>
              <Icon name='menu' />
            </Button>
          </Right>
        </Header>
    )
  }
}
