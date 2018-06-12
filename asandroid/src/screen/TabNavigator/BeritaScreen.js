import React, { Component } from 'react';
import {  View,  Text,  Image,  Linking,  StyleSheet } from "react-native";
import { Container, Header, Card, CardItem, Content, Form, Badge, H1,
  Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import Ionicons from 'react-native-vector-icons/Ionicons'
import Pusher from 'pusher-js/react-native';
import { connect } from 'react-redux'
import { BASE_URL } from '../../env'
import striptags from 'striptags'

class BeritaScreen extends Component {
  constructor(props) {
  super(props);
  this.state = {
      Berita: null,
      Posts: []
    };
  }

  componentDidMount() {
    this.getSemuaBerita(this.props.auth.token)
    this.ListenerPusher()
  }

  ListenerPusher(){
    Pusher.logToConsole = false;
    var pusher = new Pusher('dc6a1819038c28e12f36', {
      cluster: 'ap1',
      encrypted: true
    });
    var channel = pusher.subscribe('beritaEvent');
    channel.bind('App\\Events\\beritaEvent', function(data) {
      this.setState({Berita: data.message.original})
      this.mapBerita()
    }.bind(this))
  }

  getSemuaBerita() {
    fetch(BASE_URL+"api/berita", {
      method: "GET",
      headers: {
        'Accept' : 'application/json',
        'Authorization' : 'Bearer ' + this.props.auth.token
      }
    })
    .then((response) => response.json())
    .then((json) => {
      this.setState({Berita: json})
      this.mapBerita()
    })
    .catch((error) => {
      console.log(error)
    })
  }

  mapBerita() {
    let posts = this.state.Berita.map((pic) => {
      return (
        <Card key={pic.id_berita}>
          <CardItem>
            <Left>
              <Thumbnail source={{uri: 'http://localhost:8000'+pic.authornya.avatar}} />
              <Body>
                <Text>{pic.authornya.nama}</Text>
                <Text note>{pic.authornya.role.namaRule}</Text>
              </Body>
            </Left>
            <Badge info>
              <Text style={{padding: 5, color: '#fff'}}>{pic.judul}</Text>
            </Badge>
          </CardItem>
          <CardItem cardBody>

            <Text note>&emsp;{striptags(pic.content).substr(0,100)}</Text>
          </CardItem>
          <CardItem>
            <Left>

            </Left>
            <Body>

            </Body>
            <Right>
              <Button transparent dark onPress={ ()=>{ Linking.openURL('http://localhost:8000/berita/'+pic.id_berita)}}>
                <Text>Read More..</Text>
              </Button>
            </Right>
          </CardItem>
        </Card>
      )
    })
    this.setState({Posts: posts});
  }

  render() {
    return (
      <Container>
        <Content>
          {this.state.Posts}
        </Content>
      </Container>
    )
  }

}

const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({

})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(BeritaScreen)
