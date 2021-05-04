import {ContextEnum} from "./AppEnums";

export type MetaData = {
  context: ContextEnum
}

export type FormProps = {
  record?: Record<string, unknown>,
  meta: MetaData
}

export type GridPagination = {
  totalItems: number,
  totalPages: number,
  currentPage: number
}

export type QueryPageProps<T> = {
  data: T[]
  pagination: GridPagination
}
