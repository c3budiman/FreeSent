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
import { StackNavigator } from 'react-navigation';
import LoginScreen from './src/screen/LoginScreen'
import DrawerNavigator from './src/screen/DrawerNavigator'
import AboutScreen from './src/screen/AboutScreen'
import thunk from 'redux-thunk'
import { Provider } from 'react-redux'
import { createStore, applyMiddleware } from 'redux'
import rootReducer from './src/reducer'

const store = createStore(
  rootReducer,
  applyMiddleware(thunk)
)

export default class App extends React.Component {
  render() {
    return (
      <Provider store={store}>
          <AppStackNavigator />
      </Provider>

    );
  }
}

const AppStackNavigator = new StackNavigator({
  LoginScreen: { screen: LoginScreen },
  AboutScreen: { screen: AboutScreen },
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
