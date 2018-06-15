import React from "react";
import { AppRegistry, Image, StatusBar, AsyncStorage } from "react-native";
import { Container, Content, Text, List, ListItem, Icon } from "native-base";
import ProfilScreen from './TabNavigator/ProfilScreen'
import Home from './TabNavigator/BeritaScreen'
import { connect } from 'react-redux'
import { logout } from '../action'
import { BASE_URL, BASE } from '../env'
import { StackActions,NavigationActions } from 'react-navigation';
import LoginScreen from './LoginScreen'

class SideBar extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
        Setting: null,
        Logo: null,
        Favicon: null,
        Slogan: null
      };
  }

  getSettingSitus(token) {
    fetch(BASE_URL+"api/setting", {
      method: "GET",
      headers: {
        'Accept' : 'application/json',
        'Authorization' : 'Bearer ' + token
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


  componentDidMount() {
    this.getSettingSitus(this.props.auth.token)
  }

  render() {
    const { navigate } = this.props.navigation;
    const { auth } = this.props

    if (!auth.token) {
      navigate("LoginScreen")
    }

    logoutnya = (token) => {
      fetch(BASE_URL+"api/logout", {
        method: "GET",
        headers: {
          'Accept' : 'application/json',
          'Authorization' : 'Bearer ' + token
        },
      })
    }

    return (
      <Container>
        <Content>
          <Image
            source={{
              uri: BASE+this.state.Favicon
            }}
            style={{
              backgroundColor: '#fff',
              height: 100,
              width: 100,
              alignSelf: "center",
              justifyContent: "center",
              alignItems: "center",
              marginTop: 20,
              marginBottom: 20,
            }}>
          </Image>
          <Text style={{color:"#000", alignSelf: "center",marginBottom: 10, marginLeft:15, marginRight:10}} note> &emsp; <Icon name="md-remove" style={{fontSize:10}} /> {this.state.Slogan}</Text>
        <List>
          <ListItem
            button
            onPress={() => this.props.navigation.navigate("Home")}>
            <Text><Icon name="home" style={{fontSize:18}} /> &emsp; Home</Text>
          </ListItem>
          <ListItem
            button
            onPress={() => this.props.navigation.navigate("IsiPresensi")}>
            <Text><Icon name="md-checkbox" style={{fontSize:18}} /> &emsp; Isi Presensi</Text>
          </ListItem>
          <ListItem
            button
            onPress={() => this.props.navigation.navigate("Rekap")}>
            <Text><Icon name="briefcase" style={{fontSize:18}} /> &emsp; Rekap</Text>
          </ListItem>
          <ListItem
            button
            onPress={() => navigate("AboutScreen")}>
            <Text><Icon name="md-people" style={{fontSize:18}} /> &emsp; About</Text>
          </ListItem>
          <ListItem
            button
            onPress={() => {
              logoutnya(auth.token)
              AsyncStorage.removeItem('token').then(() => {
                this.props.logout()
              }).done()
            }}>
            <Text><Icon name="md-log-out" style={{fontSize:18}} /> &emsp; Log Out</Text>
          </ListItem>
        </List>
        </Content>
      </Container>
    );
  }
}

const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({
  logout: () => dispatch(logout())
})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(SideBar)
