import React, {Component} from "react";
import Top from "./Top/Top";
import Section from "./Section/Section";
import {Query} from 'react-apollo';
import gql from 'graphql-tag';

const SERVICES_QUERY = gql`
  query($id: ID!) {
    servicePage(id: $id) {
      sections {
        title
        subtitle
        text
        id
      }
    }
  }
`;

export default class Service extends Component {
    constructor(props) {
        super(props);

        this.renderCallback = this.renderCallback.bind(this);
    }

    componentDidMount() {
        new window.fullpage(".Service", {
            scrollOverflow: true,
            navigationTooltips: ["Top"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy('all');
    }

    renderCallback() {
        this.componentWillUnmount();
        this.componentDidMount();
    }

    render() {
        return (
            <div className="Service">
                <div className="section"><Top/></div>
                <Query query={SERVICES_QUERY} variables={{id: this.props.serviceId}}>
                    {({loading, error, data}) => {
                        if (loading) return null;
                        if (error) return <div className="section"><h1>Error</h1></div>;

                        setTimeout(this.renderCallback, 500);

                        return data.servicePage.sections.map((section) => {
                            return <div className="section" key={section.id} data-tooltip={section.title}>
                                <Section data={section}/>
                            </div>;
                        });
                    }}
                </Query>
            </div>
        );
    }
}