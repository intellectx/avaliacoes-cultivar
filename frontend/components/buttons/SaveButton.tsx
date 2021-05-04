import React from 'react';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faSave} from "@fortawesome/free-solid-svg-icons";
import {lang} from "../../lang";
import {Button} from "@themesberg/react-bootstrap";

export enum ContextEnum {
  DEFAULT = 'default',
  CREATE = 'create',
  UPDATE = 'update'
}

type SaveButtonProps = {
  context: ContextEnum,
  loading: boolean
};

const SaveButton: React.FunctionComponent<SaveButtonProps> = (props) => {
  const { context, loading } = props

  return (
    <Button type='submit' disabled={loading} variant="primary">
      <FontAwesomeIcon icon={faSave} className="me-2" />{' '}
      {context === ContextEnum.CREATE && lang('general.addButton')}
      {context === ContextEnum.UPDATE && lang('general.editButton')}
    </Button>
  );
};

export default SaveButton;
