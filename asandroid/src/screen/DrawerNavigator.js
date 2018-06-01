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
import HomeScreenTabNavigator from './HomeScreenTabNavigator'
import ProfilScreen from './TabNavigator/ProfilScreen'
import SideBar from './Sidebar'

const InnerStackNavigator = new StackNavigator({
  TabNavigator:{
    screen:HomeScreenTabNavigator
  }
})

const AppDrawerNavigator = new DrawerNavigator({
  Presensi: { screen: InnerStackNavigator },
  IsiPresensi: { screen: InnerStackNavigator },
  Rekap: { screen: InnerStackNavigator },
},
//akan nge render sidebar....
{
  contentComponent: props => <SideBar {...props} />
}
)

export default AppDrawerNavigator;
