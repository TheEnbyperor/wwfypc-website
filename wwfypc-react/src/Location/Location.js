import React, { Component } from 'react';
import "./Location.scss";

export default class Location extends Component {
    constructor(props) {
        super(props);

        this.mapPointerEventsOff = this.mapPointerEventsOff.bind(this);
        this.mapPointerEventsOn = this.mapPointerEventsOn.bind(this);
    }

    mapPointerEventsOn() {
        this.refs.map.setAttribute("style", "pointer-events: auto;");
    }

    mapPointerEventsOff() {
        this.refs.map.setAttribute("style", "pointer-events: none;");
    }

    componentDidMount() {
        this.refs.mapContainer.addEventListener("click", this.mapPointerEventsOn);
        this.refs.mapContainer.addEventListener("mouseleave", this.mapPointerEventsOff);
    }
    componentWillUnmount() {
        this.refs.mapContainer.removeEventListener("click", this.mapPointerEventsOn);
        this.refs.mapContainer.removeEventListener("mouseleave", this.mapPointerEventsOff);
    }

    render() {
        return (
          <div className="Location">
              <div ref="mapContainer">
                  <iframe frameBorder="0" ref="map" style={{border: 0}}
        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ5SJBiXccbkgRNu2ILxBszgo&key=AIzaSyBmGRHy0mtaNM6QNZdK2Cku3yt_u__AyBs"
        allowFullScreen/>
              </div>
              <div className="Info">
                  <div>
                      <h2>Opening Hours</h2>
                      <p>
                          Monday - Friday: 9:00am - 5:30pm <br/>
                          Saturday: 10:30am - 14:30pm <br/>
                          Closed on Bank Holidays
                      </p>
                  </div>
                  <div>
                      <h2>Address</h2>
                      <p>
                          39 Lambourne Crescent <br/>
                          Parc Ty Glas <br/>
                          Cardiff Business Park <br/>
                          Llanishen <br/>
                          Cardiff <br/>
                          CF14 5GG
                      </p>
                  </div>
                  <div>
                      <h2>Contact</h2>
                      <p>
                          (029) 20766039 <br/>
                          07999056098
                      </p>
                      <p>
                          Neil@wewillfixyourpc.co.uk
                      </p>
                  </div>
              </div>
          </div>
        );
    }
}