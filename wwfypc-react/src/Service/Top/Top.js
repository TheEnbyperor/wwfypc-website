import React, {Component} from 'react';
import {BASE_URL} from "../../App";
import './style/Top.scss';
import ReactHtmlParser, {convertNodeToElement} from "react-html-parser";

export default class Top extends Component {
    constructor(props) {
        super(props);

        this.onDown = this.onDown.bind(this);
    }

    onDown() {
        window.$.scrollify.next();
    }

    render() {
        return (
            <header className="Service-Top" style={{
                backgroundImage: `url(${BASE_URL + this.props.background})`
            }}>
                <div>
                    <div>
                        {ReactHtmlParser(this.props.text, {
                            transform: (node, index) => {
                                if (node.type === 'tag' && node.name === 'img') {
                                    const src = node.attribs["src"];
                                    if (!(src.startsWith("http://") || src.startsWith("https://"))) {
                                        node.attribs["src"] = BASE_URL + src;
                                    }
                                    return convertNodeToElement(node, index, null);
                                }
                            }
                        })}
                        <i className="fas fa-chevron-circle-down" onClick={this.onDown}/>
                    </div>
                </div>
            </header>
        )
    }
}