import React, { Component } from 'react';
import {
  Platform,
  StyleSheet,
  Text,
  Image,
  View
} from 'react-native';
import { Container, Header, Content, Form, Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import { DrawerNavigator, StackNavigator } from 'react-navigation'
import HomeScreen from './HomeScreen'
import ProfilScreen from './TabNavigator/ProfilScreen'
import Home from './TabNavigator/BeritaScreen'
import SideBar from './SideBar'
import HomeScreenTabNavigator from './HomeScreenTabNavigator'
import HomeScreenTabNavigator2 from './HomeScreenTabNavigator2'
import HomeScreenTabNavigator3 from './HomeScreenTabNavigator3'
import LoginScreen from './LoginScreen'

const InnerStackNavigator = new StackNavigator({
  TabNavigator:{
    screen:HomeScreenTabNavigator
  },
})
const InnerStackNavigator2 = new StackNavigator({
  TabNavigator:{
    screen:HomeScreenTabNavigator2
  }
})
const InnerStackNavigator3 = new StackNavigator({
  TabNavigator:{
    screen:HomeScreenTabNavigator3
  }
})


const AppDrawerNavigator = new DrawerNavigator({
  Home: { screen: InnerStackNavigator },
  IsiPresensi: { screen: InnerStackNavigator2,
      navigationOptions: {
        title: 'Isi Presensi',
    }
  },
  Rekap: { screen: InnerStackNavigator3 },
  },
{
  contentComponent: props => <SideBar {...props} />
}
//akan nge render sidebar....
// {
//   contentComponent: props => <SideBar {...props} />
// }
)

export default AppDrawerNavigator;
