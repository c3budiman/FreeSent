import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet
} from "react-native";
import { Container, Header, H3, Content, Form, Item, Input, Label, Left, Right, Button, Icon, Body, Title, Thumbnail } from 'native-base';
import { Col, Row, Grid } from "react-native-easy-grid";
import { WebView } from 'react-native';
import { connect } from 'react-redux'
import { BASE_URL } from '../../env'
import Pusher from 'pusher-js/react-native';


class ProfilScreen extends Component {
  constructor(props) {
  super(props);
  this.state = {
      Presensi: null,
      ListPresensi: [],
      TotalHours: null,
      Totalnya: null
    };
  }

  componentDidMount() {
    this.getRekapan(this.props.auth.token)

    this.ListenerPusher()
  }

  getRekapan(token) {
    fetch(BASE_URL+"api/rekap", {
      method: "GET",
      headers: {
        'Accept' : 'application/json',
        'Authorization' : 'Bearer ' + token
      }
    })
    .then((response) => response.json())
    .then((json) => {
      if (json.error) {

      } else {
        this.setState({Presensi: json.rekap, TotalHours: json.total_hours})
        if (json.rekap) {
          this.mapRekapan()
        }
      }
    })
    .catch((error) => {
      console.error(error)
    })
  }

  ListenerPusher(){
    Pusher.logToConsole = false;
    var pusher = new Pusher('dc6a1819038c28e12f36', {
      cluster: 'ap1',
      encrypted: true
    });
    var channel = pusher.subscribe('presensiEvent');
    channel.bind('App\\Events\\presensiEvent', function(data) {
      this.setState({Presensi: data.message.original.rekap, TotalHours: data.message.original.total_hours})
      this.mapRekapan()
    }.bind(this))
  }

  mapRekapan() {
    let posts = this.state.Presensi.map((pic) => {
      return (
        <Row key={pic.id_tabel}>
          <Col style={styles.border}>
                <Text style={{alignSelf: "center", marginTop:15}}>{pic.waktu_absen}</Text>
          </Col>
          <Col style={styles.border}>
                <Text style={{alignSelf: "center", marginTop:15}}>{pic.durasi_pekerjaan}</Text>
          </Col>
        </Row>
      )
    })
    this.setState({ListPresensi: posts});
  }

  render() {
    return (
          <Container>
            <Content>
              <H3 style={{marginTop:20, marginBottom:20, marginLeft:15}}>Rekapan anda di bulan ini</H3>
                <Grid style={{marginLeft:10, marginRight:10}}>
                  <Row>
                    <Col style={styles.container} >
                          <Text style={{alignSelf: "center", color:'#fff', marginTop:15}}>Tgl Absensi</Text>
                    </Col>

                    <Col style={styles.container}>
                          <Text style={{alignSelf: "center", color:'#fff', marginTop:15}}>Durasi</Text>
                    </Col>
                  </Row>
                  {this.state.ListPresensi}
                  <Row>
                    <Col style={styles.container} >
                          <Text style={{alignSelf: "center", color:'#fff', marginTop:15}}>Total Durasi : </Text>
                    </Col>

                    <Col style={styles.container2}>
                          <Text style={{alignSelf: "center", color:'#fff', marginTop:15}}>{this.state.TotalHours}</Text>
                    </Col>
                  </Row>
                </Grid>
            </Content>
        </Container>
    )
  }
}

const styles = StyleSheet.create({
  container: {
    borderRadius: 0,
    borderWidth: 0.5,
    borderColor: '#000',
    backgroundColor: '#17a2b8',
    height: 50
  },
  container2: {
    borderRadius: 0,
    borderWidth: 0.5,
    borderColor: '#000',
    backgroundColor: '#10cb00',
    height: 50
  },
  border: {
    borderRadius: 0,
    borderWidth: 0.5,
    borderColor: '#000',
    backgroundColor: '#ffffff',
    height: 50,
  },
});

// export default ProfilScreen;
const mapStateToProps = (state) => ({
  auth: state.auth
})

const mapDispatchToProps = (dispatch) => ({
  // loginFetch: (email, password) => dispatch(loginFetch(email, password)),
  // setToken: (token) => dispatch(setToken(token))
})

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(ProfilScreen)
