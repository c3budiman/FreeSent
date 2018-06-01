import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet
} from "react-native";
import HeaderFreesent from '../Layouts/Header'
import { Container, Header, Content, Form, Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';

class HomeScreen extends Component {
  render() {
    return (
      <Container>
        <HeaderFreesent />
        <View style={styles.container}>
          <Text>Wow Berhasil Login</Text>
        </View>
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


export default HomeScreen;
