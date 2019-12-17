import React, {Component, Fragment} from 'react';
import PropTypes from "prop-types";

class Reviews extends Component {
    printRating = (rating) => {
        return [1,2,3,4,5].map((index) => (
            <span key={index} className="float-right"><i className={`text-${index <= rating ? 'warning' : 'muted'} fa fa-star`} /></span>
        )).reverse();
    };

    printDate = ({ date }) => new Date(date).toLocaleDateString();

    render() {
        const { reviews } = this.props;

        return (
            <Fragment>
                {reviews.map((review) => (
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
    reviews: PropTypes.array
};

export default Reviews;
