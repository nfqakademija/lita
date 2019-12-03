import React, { PureComponent, Fragment } from 'react';
import PropTypes from 'prop-types';
import Card from "../Card";
import Filters from "./Filters";

class List extends PureComponent {
    render() {
        const { academies } = this.props;
        return (
            <Fragment>
                <Filters filterAcademies={this.props.filterAcademies} />
                <div className="row cards-list pt-5">
                    {academies.map((academy) => (
                        <div key={academy.academy_id} className="col-12 mb-5">
                            <Card academy={academy} />
                        </div>
                    ))}
                </div>
            </Fragment>
        );
    }
}

List.propTypes = {
    academies: PropTypes.arrayOf(
        PropTypes.shape({
            academy_id: PropTypes.number,
        })
    ),
    filterAcademies: PropTypes.func
};

export default List;
