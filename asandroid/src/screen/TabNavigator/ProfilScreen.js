import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet
} from "react-native";
import { Container, Header, Content, Form, Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
// import Ionicons from 'react-native-vector-icons/Ionicons'

class ProfilScreen extends Component {
  render() {
    return (
        <View style={styles.container}>
          <Text>Wow Berhasil Login</Text>
        </View>
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


export default ProfilScreen;
