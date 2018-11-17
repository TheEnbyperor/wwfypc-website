import React, {Component} from "react";
import Top from "./Top/Top";
import Section from "./Section/Section";
import {Query} from 'react-apollo';
import DocumentTitle from 'react-document-title';
import gql from 'graphql-tag';
import Footer from "../Shared/Footer/Footer";

const SERVICES_QUERY = gql`
  query($id: ID!) {
    servicePage(id: $id) {
      name
      headerBackground
      headerText
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
        window.$.scrollify({
            section: ".section",
            sectionName : "anchor",
            interstitialSection: ".fp-auto-height",
        });
        window.$.scrollify.instantMove("#top");
    }

    componentWillUnmount() {
        window.$.scrollify.destroy();
    }

    render() {
        const data = this.props.data;

        return <DocumentTitle title={data.servicePage.name + " | We Will Fix Your PC"}>
            <div className="Service">
                <div className="section" data-tooltip="Top" data-anchor="top"
                     key={data.servicePage.sections.length}>
                    <Top background={data.servicePage.headerBackground} text={data.servicePage.headerText}/>
                </div>
                {data.servicePage.sections.map((section, i) => {
                    return <div className="section" key={i} data-tooltip={section.title}
                                data-anchor={section.id}>
                        <Section data={section}/>
                    </div>;
                })}

                <div className="section fp-auto-height" data-anchor="footer"><Footer/></div>
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