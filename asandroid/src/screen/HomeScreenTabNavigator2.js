import React, { Component } from 'react';
import {
  View,
  StyleSheet
} from "react-native";
import { TabNavigator } from 'react-navigation'
import ProfilScreen from './TabNavigator/ProfilScreen'
import AbsenScreen from './TabNavigator/AbsenScreen'
import BeritaScreen from './TabNavigator/BeritaScreen'
import { Button, Text, Icon, Footer, FooterTab } from "native-base";
import { Container, Item, Input, Header, Body, Content, Title, Label, Left, Right } from 'native-base';
import Ionicons from 'react-native-vector-icons/Ionicons'
import LoginScreen from './LoginScreen'
import { BASE_URL, BASE } from '../env'
import HeaderFreesent from '../Layouts/HeaderLoggedIn'

export default class AppTabNavigator extends Component {
  static navigationOptions = ({ navigation }) => {
    return {
          header: (
          <HeaderFreesent navigation={{ navigation }} />
        )
      }
  }
  render() {
      return (
        <Container>
          <HomeScreenTabNavigator screenProps={{ navigation: this.props.navigation }}/>
        </Container>
      )
  }
}

const HomeScreenTabNavigator = new TabNavigator(
{
  Absen: {
    screen: AbsenScreen,
  },
  Profil: {
    screen: ProfilScreen,
  },
  Berita: {
    screen: BeritaScreen,
  }
},

{
  tabBarPosition: "bottom",
  tabBarComponent: props => {
        return (
          <Footer>
            <FooterTab style={{backgroundColor: '#01a3af'}}>
              <Button
                style={{backgroundColor: '#01a3af'}}
                vertical
                active={props.navigationState.index === 2}
                onPress={() => props.navigation.navigate("Berita")}>
                <Icon name="home" />
                <Text>Home</Text>
              </Button>
              <Button
                style={{backgroundColor: '#01a3af'}}
                vertical
                active={props.navigationState.index === 0}
                onPress={() => props.navigation.navigate("Absen")}>
                <Icon name="md-checkbox" />
                <Text>Isi Presensi</Text>
              </Button>
              <Button
                style={{backgroundColor: '#01a3af'}}
                vertical
                active={props.navigationState.index === 1}
                onPress={() => props.navigation.navigate("Profil")}>
                <Icon name="briefcase" />
                <Text>Rekap</Text>
              </Button>
            </FooterTab>
          </Footer>
        );
      }
    }
  );
