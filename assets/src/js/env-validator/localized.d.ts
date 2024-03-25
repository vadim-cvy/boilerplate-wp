declare const myappEnvValidator: {
  env: 'prod' | 'stg' | 'loc',
  errors: {
    general: string[],
    critical: string[],
  }
}