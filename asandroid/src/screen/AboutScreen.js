import React, { Component } from 'react';
import {  Platform,  StyleSheet,  Text,  Image, View } from 'react-native';
import { Container, Card, CardItem, Header, Content, Form, Item, Input, H1,
  Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import HeaderFreesent from '../Layouts/Header'
import { StackActions,NavigationActions } from 'react-navigation';

class AboutScreen extends Component {
    static navigationOptions = {
      title: 'About Creator',
    };

    //fungsi ini buat nge reset router, biar ga back ke login, tapi close app
    resetNavigation(targetRoute) {
      const resetAction = StackActions.reset({
        index: 0,
        actions: [
          NavigationActions.navigate({ routeName: targetRoute }),
        ],
      });
      console.log(this);
      this.props.navigation.dispatch(resetAction);
    };

    evaluateLogin() {

    }

    //good ol render
  render() {
    return (
      <View style={styles.container}>
        <Image source={{uri: 'https://avatars0.githubusercontent.com/u/1578830'}} style={{height: 200, width: 200, marginTop:50, marginBottom:20}}/>
        <Text style={{fontSize:18}}>
          FreeSent 2018 &copy;
        </Text>
        <Text style={{fontSize:18}}>
          made with <Icon name="md-heart" style={{fontSize:18, color:'rgb(255, 0, 0)'}} /> by Cecep Budiman
        </Text>
        <Text style={{fontSize:18}}>
          System Information, UG15'
        </Text>

      </View>
    )
  }
}

const styles = StyleSheet.create({
  container: {
    justifyContent: 'center',
    alignItems: 'center',
  },
});


export default AboutScreen;
