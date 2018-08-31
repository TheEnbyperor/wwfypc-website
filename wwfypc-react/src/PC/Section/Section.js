import React, {Component} from 'react';
import Laptop from './img/laptop.png';
import "./style/Section.scss";

export default class Section extends Component {
    render() {
        return (
            <div className="Section">
                <div>
                <img src={Laptop} alt=""/>
                <div>
                    <h1>A clean slate.</h1>
                    <h2>We can rebuild it.<br/>We have the technology.</h2>
                    <p>Bacon ipsum dolor amet kielbasa andouille venison beef ribs, filet mignon hamburger tenderloin
                        beef tri-tip boudin salami strip steak buffalo. Cow ground round ham hock, pork chop tail
                        biltong cupim ball tip bacon leberkas filet mignon bresaola. Pork loin andouille pig, swine
                        flank biltong kevin shoulder sausage ham hock picanha. Spare ribs t-bone buffalo, pork andouille
                        ham strip steak short ribs chicken hamburger jowl jerky fatback meatball drumstick.</p>
                </div>
                </div>
            </div>
        );
    }
}