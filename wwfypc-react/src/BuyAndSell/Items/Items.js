import React, {Component} from "react";
import './style/Items.scss';

import Button from '../../Shared/Buttons';

import Laptop from './img/Laptop.png';

class Indicators extends Component {
    render() {
        let indicators = [];
        for (let i = 0; i < this.props.num; i++) {
            indicators.push(<div className={"Indicator" + ((this.props.active === i) ? " active" : "")}
                                 key={i} onClick={() => this.props.onSelect(i)}/>)
        }
        return (
            <div className="Slide-Indicators">
                {indicators}
            </div>
        )
    }
}

class Item extends Component {
    slides = [Laptop, Laptop, Laptop];

    constructor(props) {
        super(props);

        this.setSlide = this.setSlide.bind(this);

        this.state = {
            activeSlide: 0
        };
    }

    setSlide(nextSlide) {
        if (nextSlide >= this.slides.length) {
            nextSlide = 0;
        }

        const activeSlide = this.state.activeSlide;
        let slide = activeSlide - 1;
        if (nextSlide > activeSlide) {
            slide = activeSlide + 1;
        }
        if (nextSlide === 0 && activeSlide === this.slides.length - 1) {
            slide = 0;
        }
        this.setState({
            activeSlide: slide
        });
        if (slide !== nextSlide) {
            setTimeout(() => {this.setSlide(nextSlide)}, 500);
        }
    }

    render() {
        const prevActive = (this.state.activeSlide === 0) ? this.slides.length - 1 : this.state.activeSlide - 1;
        const nextActive = ((this.state.activeSlide + 1) >= this.slides.length) ? 0 : this.state.activeSlide + 1;
        const slidesDisp = this.slides.map((slide, i) =>
            <img className={((i === this.state.activeSlide) ? "active" : "") + ((i === prevActive) ? " prevActive" : "")
            + ((i === nextActive) ? " nextActive" : "")} key={i} src={slide} alt=""/>
        );

        return (
            <div className={"Item" + ((this.props.reserved) ? " reserved" : "") +
            ((this.props.selected) ? " selected" : "")}>
                <div className="ImgSlider">
                    {slidesDisp}
                </div>
                <Indicators num={this.slides.length} active={this.state.activeSlide} onSelect={this.setSlide}/>
                <h2>Packard Bell Easynote</h2>
                <div className="specs">
                    <span>Processor:</span>
                    <span>Intel Pentium P6100 @ 2.6GHz</span>
                    <span>Memory:</span>
                    <span>5GB</span>
                    <span>Screen:</span>
                    <span>14"</span>
                    <span>Storage:</span>
                    <span>250GB HDD</span>
                    <span>OS:</span>
                    <span>Windows 7</span>
                    <span>Features:</span>
                    <span>Wireless, DVD-RW, HDMI, Webcam</span>
                    <span>Grade:</span>
                    <span>C</span>
                </div>
                <Button colour={1} small>&pound;50</Button>
                <div className="reserved">
                    <p>Reserved</p>
                    <p>Get an email if item becomes available?</p>
                    <Button colour={1} small>Sumbit email</Button>
                </div>
            </div>
        )
    }
}

export default class Items extends Component {
    render() {
        let items = [];
        for (let i = 0; i < 10; i++) {
            items.push(<Item key={i} reserved={(i % 3) === 0} selected={(this.props.selectedCategory === null) ? true
                : (((i % 4) - this.props.selectedCategory) === 0)}/>)
        }

        return (
            <div className="Items">
                {items}
            </div>
        )
    }
}