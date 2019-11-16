import React, { PureComponent } from 'react';
import PropTypes from 'prop-types';
import Card from "../Card";

class List extends PureComponent {
    render() {
        const { academies } = this.props;
        return (
            <div className="row cards-list pt-5">
                {academies.map((academy) => (
                    <div key={academy.academy_id} className="col-12 mb-5 mr-5">
                        <Card academy={academy} />
                    </div>
                ))}
            </div>
        );
    }
}

List.propTypes = {
    academies: PropTypes.arrayOf(
        PropTypes.shape({
            academy_id: PropTypes.number,
        })
    )
};

export default List;
