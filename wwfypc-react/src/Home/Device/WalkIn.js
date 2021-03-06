import React, {Component} from "react";
import {Query} from 'react-apollo';
import gql from 'graphql-tag';
import Button from '../../Shared/Buttons';
import './style/WalkIn.scss'

const WALK_IN_QUERY = gql`
  {
    siteConfig {
      address
      googleMapsPlaceId
      openingHours
    }
  }
`;

export default class WalkIn extends Component {
    render() {
        return (
            <div className="WalkIn">
                <h2>Here's how to find us</h2>
                <Query query={WALK_IN_QUERY}>
                    {({loading, error, data}) => {
                        if (loading) return <h2>Loading</h2>;
                        if (error) return <h2>Error</h2>;

                        return [
                            <div className="Info" key={0}>
                                <div>
                                    <h2>Opening Hours</h2>
                                    <p dangerouslySetInnerHTML={{__html: data.siteConfig.openingHours}}/>
                                </div>
                                <div>
                                    <h2>Address</h2>
                                    <p dangerouslySetInnerHTML={{__html: data.siteConfig.address}} />
                                </div>
                                <div>
                                    <iframe title="google map" frameBorder="0" style={{border: 0}}
                                            src={"https://www.google.com/maps/embed/v1/place?q=place_id:" +
                                            data.siteConfig.googleMapsPlaceId +
                                            "&key=AIzaSyBmGRHy0mtaNM6QNZdK2Cku3yt_u__AyBs"} allowFullScreen/>
                                </div>
                            </div>,
                            <Button key={1} colour={4} onClick={this.props.onSelectBack}>Back</Button>
                        ];
                    }}
                </Query>
            </div>
        );
    }
}