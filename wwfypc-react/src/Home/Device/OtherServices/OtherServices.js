import React, {Component} from 'react';
import Button from "../../../Shared/Buttons";

export default class OtherServices extends Component {
    render() {
        return (
            <div className="Devices">
                <div>
                    <div>
                        <div>
                            <h3>VHS to digital</h3>
                            <p>Bacon ipsum dolor amet tail flank tongue, corned beef short loin doner pork chop
                                pastrami ham hock ground round pork loin.</p>
                        </div>
                        <Button colour={1} small>Learn more</Button>
                    </div>
                    <div>
                        <div>
                            <h3>Custom built arcade cabs</h3>
                            <p>Bacon ipsum dolor amet tail flank tongue, corned beef short loin doner pork chop
                                pastrami ham hock ground round pork loin.</p>
                        </div>
                        <Button colour={1} small>Learn more</Button>
                    </div>
                    <div>
                        <div>
                            <h3>Buying & Selling</h3>
                            <p>Bacon ipsum dolor amet tail flank tongue, corned beef short loin doner pork chop
                                pastrami ham hock ground round pork loin.</p>
                        </div>
                        <Button colour={1} small>Learn more</Button>
                    </div>
                    <div>
                        <div>
                            <h3>Carrier unlocking</h3>
                            <p>Bacon ipsum dolor amet tail flank tongue, corned beef short loin doner pork chop
                                pastrami ham hock ground round pork loin.</p>
                        </div>
                        <Button colour={1} small>Learn more</Button>
                    </div>
                </div>
                <div className="other">
                    <Button colour={4} onClick={this.props.onSelectBack}>Back</Button>
                </div>
            </div>
        );
    }
}