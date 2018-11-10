import React, {Component} from "react";
import Top from "./Top/Top";
import Section from "./Section/Section";
import {Query} from 'react-apollo';
import DocumentTitle from 'react-document-title';
import gql from 'graphql-tag';

const SERVICES_QUERY = gql`
  query($id: ID!) {
    servicePage(id: $id) {
      name
      headerBackground
      sections {
        image
        title
        subtitle
        text
        id
      }
    }
  }
`;

class InnerService extends Component {
    componentDidMount() {
        new window.fullpage(".Service", {
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
            scrollOverflow: true,
            scrollBar: true,
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    render() {
        const data = this.props.data;

        return <DocumentTitle title={data.servicePage.name + " | We Will Fix Your PC"}>
            <div className="Service">
                <div className="section" data-tooltip="Top" data-anchor="top"
                     key={data.servicePage.sections.length}>
                    <Top background={data.servicePage.headerBackground}/>
                </div>
                {data.servicePage.sections.map((section, i) => {
                    return <div className="section" key={i} data-tooltip={section.title}
                                data-anchor={section.id}>
                        <Section data={section}/>
                    </div>;
                })}
            </div>
        </DocumentTitle>;
    }
}

export default class Service extends Component {
    render() {
        return (
            <Query query={SERVICES_QUERY} variables={{id: this.props.serviceId}}>
                {({loading, error, data}) => {
                    if (loading) return null;
                    if (error) return <div className="section"><h1>Error</h1></div>;

                    return <InnerService data={data}/>;
                }}
            </Query>
        );
    }
}