import React, { Component } from 'react';
import {
  View,
  Text,
  Image,
  WebView,
  AsyncStorage,
  StyleSheet
} from "react-native";
import { Container, Header, Card, CardItem, Content, Form, Badge,
  Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import Ionicons from 'react-native-vector-icons/Ionicons'
import { connect } from 'react-redux'
import { BASE_URL } from '../../env'
import JailMonkey from 'jail-monkey'
import { absenFetch,setID,logoutAbsenFetch,destroyID } from '../../action'



class AbsenScreen extends Component {
  constructor(props) {
  super(props);
  this.state = {
      latitude: null,
      longitude: null,
      error: null,
      trustedDevice: null,
      rendernya: null,
      TerLoginAbsen: false
    };
  }

  componentWillMount () {
    this.isJailBroken = JailMonkey.isJailBroken()
    this.canMockLocation = JailMonkey.canMockLocation()
    this.trustFall = JailMonkey.trustFall()
    this.setState({trustedDevice: this.trustFall})
    this.fetchLocation()
  }

  componentDidMount() {
    AsyncStorage.getItem('id_presensi').then((data)=> {
      if (data) {
        this.props.setID(data)
      }
    }).done()
    this.fetchLocation()
  }

  fetchLocation() {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        this.setState({
          latitude: position.coords.latitude,
          longitude: position.coords.longitude,
          error: null,
        });
      },
      (error) => this.setState({ error: error.message }),
      { enableHighAccuracy: true, timeout: 20000, maximumAge: 1000 },
    );
  }

  doAbsen() {
    if (this.state.latitude === null || this.state.longitude === null) {
      alert('Error! pastikan gps menyala!')
      this.fetchLocation()
    } else {
      this.props.absenFetch(this.props.auth.token , this.state.latitude + ',' + this.state.longitude)
    }
  }

  LogoutAbsen() {
    this.props.logoutAbsenFetch(this.props.auth.token , this.props.auth.id_presensi)
    AsyncStorage.removeItem('id_presensi').then(() => {
      this.props.destroyID()
    }).done()
  }

  render() {
    if (this.props.auth.id_presensi === null || this.props.auth.id_presensi === "") {
      return (
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
                  onPress={() =>  this.doAbsen() }
                  style={{
                                marginTop:40,
                        }}
                  >

                  <Text
                    style={{
                                padding:20,
                                color:'#fff',
                          }}
                    >Login Presensi</Text>
                </Button>
              </CardItem>
            </Card>
          </Content>
        </Container>
      )
    } else {
      return(
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
                  onPress={() => this.LogoutAbsen() }
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
      )
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


const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({
  logoutAbsenFetch: (token,id) => dispatch(logoutAbsenFetch(token,id)),
  absenFetch: (token,lokasi) => dispatch(absenFetch(token,lokasi)),
  setID: (id_presensi) => dispatch(setID(id_presensi)),
  destroyID: (id_presensi) => dispatch(destroyID(id_presensi))
})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(AbsenScreen)
