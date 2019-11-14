import React, { Fragment, PureComponent } from 'react';
import PropTypes from 'prop-types';
import Card from "../Card";

class List extends PureComponent {
    render() {
        const { academies } = this.props;
        return (
            <Fragment>
                {academies.map((academy) => (
                    <div key={academy.academy_id} className="mb-5">
                        <Card academy={academy} />
                    </div>
                ))}
            </Fragment>
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