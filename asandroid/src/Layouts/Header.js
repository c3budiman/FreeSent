import React , { Component } from 'react';
import { View, Image } from 'react-native';
import { Container, Item, Input, Header, Body, Content, Title, Button, Text, Label } from 'native-base';
import { BASE_URL, BASE } from '../env'

export default class HeaderFreesent extends Component {
  constructor(props) {
    super(props);
    this.state = {
        NamaSitus: null,
        Logo: null,
        Favicon: null,
        Slogan: null
      };
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
        this.setState({Logo: json.data.logo, Favicon: json.data.favicon, NamaSitus: json.data.namaSitus})
      }
    })
    .catch((error) => {
      console.error(error)
    })
  }

  componentDidMount() {
    this.getSettingSitus()
  }

  render(){
    console.log(this)
    return (
        <Header style={{backgroundColor: '#01a3af'}} >
          <Body>
            <Title>Tes</Title>
          </Body>
        </Header>
    )
  }
}
