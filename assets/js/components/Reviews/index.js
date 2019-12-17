import React, {Component, Fragment} from 'react';
import { addReview } from '../../services/api';
import PropTypes from "prop-types";

class Reviews extends Component {
    constructor(props) {
        super(props);
        this.comment = React.createRef();
        this.starsLabel = React.createRef();
    }
    state = {
        stars: 0,
        error: null,
        reviews: this.props.reviews
    };

    submitReview = async () => {
        try {
            if (this.state.stars !== 0) {
                await addReview(this.props.programId, this.state.stars, this.comment.current.value);

                const updatedReviews = [...this.state.reviews];
                updatedReviews.push({
                    consumer: window.__user,
                    rating: this.state.stars,
                    comment: this.comment.current.value,
                    date: { date: new Date().toISOString().substring(0,10) },
                    id: 'temporary'
                });

                this.setState({ reviews: updatedReviews })
            } else {
                this.starsLabel.current.classList.add('text-danger');
            }
        } catch (error) {
            this.setState({
                error: error.response.data
            })
        }
    };

    setStars = (event) => {
        this.starsLabel.current.classList.remove('text-danger');
        this.setState({
            stars: event.currentTarget.dataset.stars
        })
    };

    printStars = () => {
        const { stars } = this.state;

        return [1,2,3,4,5].map((index) => (
            <button key={index} type="button" className={`btn ${index <= stars ? 'btn-warning' : 'btn-default'}`} data-stars={index} onClick={this.setStars}>
                <i className="fa fa-star" aria-hidden="true" />
            </button>
        ))
    };

    printRating = (rating) => {
        return [1,2,3,4,5].map((index) => (
            <span key={index} className="float-right"><i className={`text-${index <= rating ? 'warning' : 'muted'} fa fa-star`} /></span>
        )).reverse();
    };

    printReviewForm = () => {
        return window.__user !== 'empty'
            ? (
                <div className="mb-5">
                    {this.state.error !== null
                        ? (
                                <div className="alert alert-danger" role="alert">
                                    {this.state.error}
                                </div>
                            )
                        : null
                    }
                    <div className="form-group">
                        <label className="control-label" htmlFor="comment">Rašyti atsiliepimą:</label>
                        <textarea ref={this.comment} className="form-control" name="comment" rows="3" />
                    </div>
                    <div className="form-group required" id="rating-ability-wrapper">
                        <span ref={this.starsLabel} className="field-label-header control-label">Kaip vertintumėte šią programą?</span>
                        <div>
                            {this.printStars()}
                        </div>
                    </div>
                    <p><small>Atsiliepimą apie programą galima palikti tik vieną kartą.</small></p>
                    <button type="submit" className="btn btn-primary mb-2" onClick={this.submitReview}>Skelbti</button>
                </div>
            )
            : (
                <div className="row mb-5 mt-2">
                    <div className="col-md-12">
                        <p>Norėdami palikti atsiliepimą, prašome prisijungti su Google paskyra.</p>
                        <a
                            type="button"
                            href="/connect/google"
                            className="btn btn-outline-dark btn-block-sm-only"
                        >
                            <img width="20px" className="mr-2" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                            Prisijungti su Google
                        </a>
                    </div>
                </div>
            )
    }

    printDate = ({ date }) => new Date(date).toLocaleDateString();

    render() {
        const { reviews } = this.state;

        return (
            <Fragment>
                {this.printReviewForm()}
                {reviews.length === 0
                    ? 'Akademija kol kas neturi atsiliepimų.'
                    : reviews.map((review) => (
                        <div key={review.id} className="card mb-2">
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-md-12">
                                        <div>
                                            <span><strong>{review.consumer !== null ? review.consumer : 'Anonimas'}</strong></span>
                                            {this.printRating(review.rating)}
                                        </div>
                                        <div className="text-secondary text-left mb-3">{this.printDate(review.date)}</div>
                                        <div className="clearfix"></div>
                                        <p>{review.comment}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
            </Fragment>
        );
    }
}

Reviews.propTypes = {
    reviews: PropTypes.array,
    programId: PropTypes.number
};

export default Reviews;
