import React, { Component } from 'react';
import {
  View,
  Text,
  Image,
  StyleSheet
} from "react-native";
import { Container, Header, Card, CardItem, Content, Form, Badge,
  Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import Ionicons from 'react-native-vector-icons/Ionicons'
// import Pusher from 'pusher-js/react-native';
importScripts('https://js.pusher.com/4.2/pusher.worker.min.js');
import { connect } from 'react-redux'
import { BASE_URL } from '../../env'

class BeritaScreen extends Component {
  constructor(props) {
  super(props);
  this.state = {
      Berita: []
    };
  }

  test() {
    Pusher.logToConsole = true;

    var pusher = new Pusher('dc6a1819038c28e12f36', {
      cluster: 'ap1',
      encrypted: true
    });

    var channel = pusher.subscribe('beritaEvent');
    channel.bind('App\\Events\\beritaEvent', function(data) {
      this.setState({Berita: data.message});
    });
  }

  componentDidMount() {
    console.log(this.props.auth.token)
    fetch(BASE_URL+"api/berita", {
      method: "GET",
      headers: {
        'Accept' : 'application/json',
        'Authorization' : 'Bearer ' + this.props.auth.token
      }
    })
    .then((response) => response.json())
    .then((json) => {
      console.log(json)
      this.setState({Berita: json})
      console.log(this.state.Berita[0].judul)
    })
    .catch((error) => {
      console.log(error)
    })
  }

  render() {
    const { auth } = this.props
    FetchBerita = (token) => {
      console.log(auth.token)
      fetch(BASE_URL+"api/berita", {
        method: "GET",
        headers: {
          'Accept' : 'application/json',
          'Authorization' : 'Bearer ' + token
        },
      })
      .then((response) => response.json())
      .then((json) => {
        console.log(json)
      })
      .catch((error) => {
        console.log(error)
      })
    }

    return (
      <Container>
        <Content>
          <Card>
            <CardItem>
              <Left>
                <Thumbnail source={{uri: 'https://github.com/c3budiman/FreeSent/blob/master/absensi/public/avatar/avatar.png?raw=true'}} />
                <Body>
                  <Text>c3budiman</Text>
                  <Text note>Admin</Text>
                </Body>
              </Left>
              <Badge info>
                <Text style={{padding: 5, color: '#fff'}}>Pengumuman</Text>
              </Badge>
            </CardItem>
            <CardItem cardBody>
              <Text note>&emsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, consectetur adipisicing elit....</Text>
            </CardItem>
            <CardItem>
              <Left>

              </Left>
              <Body>

              </Body>
              <Right>
                <Button transparent dark>
                  <Text>Read More..</Text>
                </Button>
              </Right>
            </CardItem>
          </Card>
          <Card>
            <CardItem>
              <Left>
                <Thumbnail source={{uri: 'https://github.com/c3budiman/FreeSent/blob/master/absensi/public/avatar/avatar.png?raw=true'}} />
                <Body>
                  <Text>c3budiman</Text>
                  <Text note>Admin</Text>
                </Body>
              </Left>
              <Badge info>
                <Text style={{padding: 5, color: '#fff'}}>Pengumuman</Text>
              </Badge>
            </CardItem>
            <CardItem cardBody>
              <Text note>&emsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, consectetur adipisicing elit....</Text>
            </CardItem>
            <CardItem>
              <Left>

              </Left>
              <Body>

              </Body>
              <Right>
                <Button transparent dark>
                  <Text>Read More..</Text>
                </Button>
              </Right>
            </CardItem>
          </Card>
        </Content>
      </Container>
    )
  }
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});


const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({
  logout: () => dispatch(logout())
})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(BeritaScreen)
