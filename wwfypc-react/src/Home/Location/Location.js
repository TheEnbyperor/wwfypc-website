import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./Location.scss";

const INFO_QUERY = gql`
  {
    siteConfig {
      landline
      mobile
      openingHours
      address
      email
      googleMapsPlaceId
    }
  }
`;

class Map extends Component {
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
            <div ref="mapContainer">
                <iframe title="google map" frameBorder="0" ref="map" style={{border: 0}}
                        src={"https://www.google.com/maps/embed/v1/place?q=place_id:" +
                        this.props.placeId +
                        "&key=AIzaSyBmGRHy0mtaNM6QNZdK2Cku3yt_u__AyBs"} allowFullScreen/>
            </div>
        );
    }
}

export default class Location extends Component {
    render() {
        return (
            <div className="Location">
                <Query query={INFO_QUERY}>
                    {({loading, error, data}) => {
                        if (!loading && !error) {
                            return [
                                <div className="Info" key={1}>
                                    <div>
                                    <div>
                                        <div>
                                            <h2>Opening Hours</h2>
                                            <p>{data.siteConfig.openingHours}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <h2>Address</h2>
                                            <p>{data.siteConfig.address}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <h2>Contact</h2>
                                            <p>
                                                {data.siteConfig.landline}<br/>
                                                {data.siteConfig.mobile}
                                            </p>
                                            <p>{data.siteConfig.email}</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>,
                                <Map key={2} placeId={data.siteConfig.googleMapsPlaceId}/>
                            ];
                        } else {
                            return null;
                        }
                    }}
                </Query>
            </div>
        )
            ;
    }
}