// /**
//  * Sample React Native App
//  * https://github.com/facebook/react-native
//  * @flow
//  */
//
import React, { Component } from 'react';
import {
  Platform,
  StyleSheet,
  Text,
  Image,
  View
} from 'react-native';
import { Container, Header, Content, Form, Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import HeaderFreesent from './src/Layouts/Header'
import LoginPage from './src/Login'
import { StackNavigator } from 'react-navigation';
import LoginScreen from './src/screen/LoginScreen'
import DrawerNavigator from './src/screen/DrawerNavigator'

export default class App extends React.Component {
  render() {
    return (
      <AppStackNavigator />
    );
  }
}

const AppStackNavigator = new StackNavigator({
  LoginScreen: { screen: LoginScreen },
  DrawerNavigator: { screen: DrawerNavigator,
      navigationOptions: {
        header: () => null,
      }
    }
  },

  {
  navigationOptions: {
    gestureEnabled: false
  },
})
