import React, { Component } from 'react';
import {
  View,
  Text,
  Image,
  WebView,
  StyleSheet
} from "react-native";
import { Container, Header, Card, CardItem, Content, Form, Badge,
  Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import Ionicons from 'react-native-vector-icons/Ionicons'
import { connect } from 'react-redux'
import { BASE_URL } from '../../env'


class AbsenScreen extends Component {
  constructor(props) {
  super(props);
  this.state = {
      TerLoginAbsen: false
    };
  }

  doAbsen() {
    this.setState({TerLoginAbsen: true});
  }

  LogoutAbsen() {
    this.setState({TerLoginAbsen: false});
  }

  render() {
    if (!this.state.TerLoginAbsen) {
      return (
        //absen
        <Container>
          <Content>
            <Card style={{
                          padding:20,
                          flex: 1,
                          alignSelf: "center",
                          justifyContent: "center",
                          alignItems: "center"
                        }}
                        >
              <CardItem cardBody>

                <Text note>Silahkan aktifkan terlebih dahulu GPS anda dan tunggu beberapa menit,
                agar Lokasi yang dilaporkan sesuai. Jangan pernah menggunakan vpn atau alat menipu gps,
                jika terdeteksi sistem akun anda akan di nonaktifkan </Text>
              </CardItem>

              <CardItem>
                <Button large rounded success
                  onKeyPress={() => {
                                this.setState({TerLoginAbsen: true});
                              }}
                  style={{
                                marginTop:40,
                        }}
                  >
                  <Text
                    style={{
                                color:'#fff',
                                padding:20,
                          }}
                    >Login Presensi</Text>
                </Button>
              </CardItem>

            </Card>
          </Content>
        </Container>
      )
    } else {
      //logout absen
      <Container>
        <Content>
          <Card style={{
                        padding:20,
                        flex: 1,
                        alignSelf: "center",
                        justifyContent: "center",
                        alignItems: "center"
                      }}
                      >
            <CardItem cardBody>
              <Text note>Jika telah selesai bekerja harap melogout akun anda,
                sistem akan melogout otomatis pada pukul 18.00 WIB,
                lupa melogout sebanyak 3x akan dikenakan sanksi</Text>
            </CardItem>

            <CardItem>
              <Button large rounded danger
                style={{
                              marginTop:40,
                      }}
                >
                <Text
                  style={{
                              color:'#fff',
                              padding:20,
                        }}
                  >Logout Presensi</Text>
              </Button>
            </CardItem>
          </Card>
        </Content>
      </Container>
    }

  }
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
});


export default AbsenScreen;
