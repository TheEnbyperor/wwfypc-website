import React, {Component} from 'react';
import Menu from './Menu';
import Button from '../Shared/Buttons';
import './style/Top.scss';
import iPhone from './img/iphone-x.png';
import PostIt from './img/post-it.svg';
import Clock from './img/clock.svg';
import IMac from './img/imac.svg';
import SliderBg1 from './img/slider-bg.jpg';
import SliderBg2 from './img/slider-bg-2.jpg';
import SliderBg3 from './img/slider-bg-3.jpg';
import SliderBg4 from './img/slider-bg-4.jpg';

class TopLeft extends Component {
    render() {
        return (
            <div className="TopLeft">
                <h2>Welcome to</h2>
                <h1>We Will Fix Your PC</h1>
                <p>You've arrived at We Will Fix Your PC. <br/> If your looking for expert help with your computer or
                    phone - without breaking the bank, then search no further.</p>
                <div className="buttons">
                    <Button colour={1}>Start your repair</Button>
                    <Button colour={2}>Learn more</Button>
                </div>
            </div>
        )
    }
}

function getRenderedSize(contains, cWidth, cHeight, width, height, pos) {
    var oRatio = width / height,
        cRatio = cWidth / cHeight;
    return function () {
        if (contains ? (oRatio > cRatio) : (oRatio < cRatio)) {
            this.width = cWidth;
            this.height = cWidth / oRatio;
        } else {
            this.width = cHeight * oRatio;
            this.height = cHeight;
        }
        this.left = (cWidth - this.width) * (pos / 100);
        this.right = this.width + this.left;
        return this;
    }.call({});
}

function getImgSizeInfo(img, width) {
    var pos = window.getComputedStyle(img).getPropertyValue('object-position').split(' ');
    return getRenderedSize(true,
        img.width,
        img.height,
        width,
        img.naturalHeight,
        parseInt(pos[0]));
}

class TopRight extends Component {
    slides = [
        {
            img: PostIt,
            bg: SliderBg1,
            title: "Post it",
            text: "Now you can mail in your devices, we'll repair them and ship them back safely",
            button: "Mail in your device"
        },
        {
            img: Clock,
            bg: SliderBg4,
            title: "Quick Fix",
            text: "iPhones fix in 30 minutes and iPads can be done on the same day",
            button: "Book your repair"
        },
        {
            img: IMac,
            bg: SliderBg2,
            title: "No fix, no fee, guaranteed",
            text: "We offer free advice, diagnostics, and quotes so you can remain in control",
            button: "Get your free quote"
        },
        {
            img: Clock,
            bg: SliderBg3,
            title: "Buy and sell",
            text: "Weather you're looking for a new computer or phone, we'll help you safely transfer your data and" +
                " recycle your electronics",
            button: "Buy or sell today"
        }
    ];
    slidesTimer = null;

    constructor(props) {
        super(props);

        this.updateDimensions = this.updateDimensions.bind(this);
        this.moveSlide = this.moveSlide.bind(this);

        this.state = {
            activeSlide: 0
        };
    }

    updateDimensions() {
        const img = this.refs.img;
        const size = getImgSizeInfo(img, 338);

        this.refs.slides.setAttribute("style", "width: " + size.width + "px;");
    }

    moveSlide() {
        let nextSlide = this.state.activeSlide + 1;
        if (nextSlide >= this.slides.length) {
            nextSlide = 0;
        }
        this.setState({
            activeSlide: nextSlide
        })
    }

    componentDidMount() {
        window.addEventListener("resize", this.updateDimensions);
        setTimeout(this.updateDimensions, 500);
        this.slidesTimer = setInterval(this.moveSlide, 4000);
    }

    componentWillUnmount() {
        window.removeEventListener("resize", this.updateDimensions);
        clearInterval(this.slidesTimer);
    }

    render() {
        const prevActive = (this.state.activeSlide === 0) ? this.slides.length - 1 : this.state.activeSlide - 1;
        const nextActive = ((this.state.activeSlide + 1) >= this.slides.length) ? 0 : this.state.activeSlide + 1;
        console.log(this.state.activeSlide, prevActive, nextActive);
        const slidesDisp = this.slides.map((slide, i) =>
            <div className={"TopSlide" + ((i === this.state.activeSlide) ? " active" : "") +
            ((i === prevActive) ? " prevActive" : "") + ((i === nextActive) ? " nextActive" : "")} key={i}>
                <div className="TopImg">
                    <img src={slide.bg} alt=""/>
                    <img src={slide.img} alt=""/>
                </div>
                <h2>{slide.title}</h2>
                <p>{slide.text}</p>
                <Button colour={1}>{slide.button}</Button>
            </div>
        );

        return (
            <div className="TopRight">
                <div className="TopSlider">
                    <div className="TopSlidesInner">
                        <div className="SliderImg">
                            <img src={iPhone} alt="" className="overlay" ref="img"/>
                        </div>
                        <div className="TopSlides" ref="slides">
                            {slidesDisp}
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default class Top extends Component {
    render() {
        return (
            <header className="Top">
                <Menu/>
                <div className="TopContent">
                    <TopLeft/>
                    <TopRight/>
                </div>
            </header>
        )
    }
}