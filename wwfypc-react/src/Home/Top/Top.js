import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import {Link} from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';
import Button from '../../Shared/Buttons';
import './style/Top.scss';
import iPhone from './img/iphone-x.png';
import {HashLink} from "../../Shared/Menu";
import {BASE_URL} from "../../App";

const SLIDER_QUERY = gql`
  {
    mainSliderSlides {
      id
      title
      colour
      text
      buttonText
      linkTo
      image
      backgroundImage
    }
  }
`;

class TopLeft extends Component {
    render() {
        return (
            <div className="TopLeft">
                <h2>Welcome to</h2>
                <h1 className="large">We Will Fix Your PC</h1>
                <p>You've arrived at We Will Fix Your PC. <br/> If your looking for expert help with your computer or
                    phone - without breaking the bank, then search no further.</p>
                <div className="buttons">
                    <HashLink to="/" hash="#device">
                        <Button colour={1}>Start your repair</Button>
                    </HashLink>
                    <HashLink to="/" hash="#about">
                        <Button colour={2}>Learn more</Button>
                    </HashLink>
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
        parseInt(pos[0], 10));
}

class TopRight extends Component {
    render() {
        return <Query query={SLIDER_QUERY}>
            {({loading, error, data}) => {
                if (!loading && !error) {
                    return (
                        <TopRightSlider slides={data.mainSliderSlides}/>
                    )
                } else {
                    return null;
                }
            }}
        </Query>
    }
}

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

const SLIDE_TIMER = 6000;

class TopRightSlider extends Component {
    slidesTimer = null;

    constructor(props) {
        super(props);

        this.updateDimensions = this.updateDimensions.bind(this);
        this.moveSlide = this.moveSlide.bind(this);
        this.setSlide = this.setSlide.bind(this);

        this.state = {
            activeSlide: 0
        };
    }

    updateDimensions() {
        const img = this.refs.img;
        const size = getImgSizeInfo(img, 223);

        this.refs.slides.setAttribute("style", "width: " + size.width + "px;");
    }

    moveSlide() {
        let nextSlide = this.state.activeSlide + 1;
        this.setSlide(nextSlide);
    }

    setSlide(nextSlide) {
        if (nextSlide >= this.props.slides.length) {
            nextSlide = 0;
        }

        const activeSlide = this.state.activeSlide;
        let slide = activeSlide - 1;
        if (nextSlide > activeSlide) {
            slide = activeSlide + 1;
        }
        if (nextSlide === 0 && activeSlide === this.props.slides.length - 1) {
            slide = 0;
        }
        this.setState({
            activeSlide: slide
        });
        if (slide !== nextSlide) {
            setTimeout(() => {
                this.setSlide(nextSlide)
            }, 500);
        }
        clearTimeout(this.slidesTimer);
        this.slidesTimer = setTimeout(this.moveSlide, SLIDE_TIMER);
    }

    componentDidMount() {
        window.addEventListener("resize", this.updateDimensions);
        setTimeout(this.updateDimensions, 1000);
        this.slidesTimer = setTimeout(this.moveSlide, SLIDE_TIMER);
    }

    componentWillUnmount() {
        window.removeEventListener("resize", this.updateDimensions);
        clearInterval(this.slidesTimer);
    }

    render() {
        const prevActive = (this.state.activeSlide === 0) ? this.props.slides.length - 1 : this.state.activeSlide - 1;
        const nextActive = ((this.state.activeSlide + 1) >= this.props.slides.length) ? 0 : this.state.activeSlide + 1;
        const slidesDisp = this.props.slides.map((slide, i) =>
            <div className={"TopSlide" + ((i === this.state.activeSlide) ? " active" : "") +
            ((i === prevActive) ? " prevActive" : "") + ((i === nextActive) ? " nextActive" : "")} key={slide.id}>
                <div className="TopImg">
                    <img src={BASE_URL + slide.backgroundImage} alt=""/>
                    <img src={BASE_URL + slide.image} alt=""/>
                    <Indicators num={this.props.slides.length} active={this.state.activeSlide}
                                onSelect={this.setSlide}/>
                </div>
                <h2 className={"colour-" + slide.colour}>{slide.title}</h2>
                {ReactHtmlParser(slide.text)}
                <Link to={slide.linkTo}>
                    <Button colour={1}>{slide.buttonText}</Button>
                </Link>
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
                <div className="TopContent">
                    <TopLeft/>
                    <TopRight/>
                </div>
            </header>
        )
    }
}