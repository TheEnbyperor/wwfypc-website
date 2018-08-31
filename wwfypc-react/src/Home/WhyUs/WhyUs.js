import React, {Component} from 'react';
import "./style/WhyUs.scss";

export default class WhyUs extends Component {
    render() {
        return (
            <div className="WhyUs">
                <div>
                    <h1>Why choose us?</h1>
                    <p>
                        We enjoy an excellent reputation built on fifteen years of delivering outstanding service
                        and value for money. When you ask us to repair you'r computer, you can expect to receive
                        personal
                        and courteous advice and assistance from experts who care. We'll explain what's wrong with
                        your device in plain, jargon-free english, and tell you exactly how much it will cost to fix
                        - we guarantee it'll be the lowest price you find anywhere.
                    </p>
                    <p>
                        We're a local company based in an easily accessible location in Cardiff, but if you're unable to
                        get to us don't worry. We offer a free pickup and return delivery service, and if you're stuck
                        without a computer we'll even loan you a free courtesy laptop while we carry out your repair.
                        We also operate a no fix, no fee guarantee, so you can be confident that in the unlikely event
                        that we're unable to fix your device it won't cost you a penny.
                    </p>
                </div>
            </div>
        );
    }
}