import React , { Component } from 'react';
import { View, Image } from 'react-native';
import { Container, Item, Input, Header, Body, Content, Title, Button, Text, Label, Left, Icon, Right } from 'native-base';
import { BASE_URL, BASE } from '../env'

export default class HeaderFreesent extends Component {
  render(){
    return (
      <Header style={{backgroundColor: '#01a3af'}} >
        <Body>
          <Title>FreeSent App</Title>
        </Body>
      </Header>
    )
  }
}
